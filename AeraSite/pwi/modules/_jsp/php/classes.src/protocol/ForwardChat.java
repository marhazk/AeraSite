/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ import com.goldhuman.service.interfaces.ChatInfo;
/*    */ import com.goldhuman.util.LocalDB;
/*    */ import java.io.PrintStream;
/*    */ 
/*    */ public final class ForwardChat extends Protocol
/*    */ {
/*    */   public int zoneid;
/*    */   public int lineid;
/*    */   public int userid;
/*    */   public int roleid;
/*    */   public Octets name;
/*    */   public Octets msg;
/*    */ 
/*    */   public ForwardChat()
/*    */   {
/* 25 */     this.name = new Octets();
/* 26 */     this.msg = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 31 */     os.marshal(this.zoneid);
/* 32 */     os.marshal(this.lineid);
/* 33 */     os.marshal(this.userid);
/* 34 */     os.marshal(this.roleid);
/* 35 */     os.marshal(this.name);
/* 36 */     os.marshal(this.msg);
/* 37 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 42 */     this.zoneid = os.unmarshal_int();
/* 43 */     this.lineid = os.unmarshal_int();
/* 44 */     this.userid = os.unmarshal_int();
/* 45 */     this.roleid = os.unmarshal_int();
/* 46 */     os.unmarshal(this.name);
/* 47 */     os.unmarshal(this.msg);
/* 48 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 55 */       ForwardChat o = (ForwardChat)super.clone();
/* 56 */       o.name = ((Octets)this.name.clone());
/* 57 */       o.msg = ((Octets)this.msg.clone());
/* 58 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 61 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session) throws ProtocolException
/*    */   {
/*    */     try {
/* 67 */       ChatInfo ci = new ChatInfo();
/* 68 */       ci.time = ((int)(System.currentTimeMillis() / 1000L));
/* 69 */       ci.zoneid = this.zoneid;
/* 70 */       ci.lineid = this.lineid;
/* 71 */       ci.userid = this.userid;
/* 72 */       ci.roleid = this.roleid;
/* 73 */       ci.name = new String(this.name.getBytes(), "UTF-16LE");
/* 74 */       ci.msg = new String(this.msg.getBytes(), "UTF-16LE");
/* 75 */       LocalDB.getInstance(1000, 10000, 7200, false).addChatInfo(ci);
/* 76 */       System.out.println("ForwardChat, zoneid=" + this.zoneid + ",lineid=" + this.lineid + ",userid=" + this.userid + ",roleid=" + this.roleid + ",name=" + ci.name + ",msg=" + ci.msg);
/*    */     } catch (Exception ex) {
/* 78 */       ex.printStackTrace();
/*    */     }
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.ForwardChat
 * JD-Core Version:    0.6.2
 */