/*    */ package protocol;
/*    */ 
/*    */ import com.goldhuman.Common.Marshal.MarshalException;
/*    */ import com.goldhuman.Common.Marshal.OctetsStream;
/*    */ import com.goldhuman.Common.Octets;
/*    */ import com.goldhuman.IO.Protocol.Manager;
/*    */ import com.goldhuman.IO.Protocol.Protocol;
/*    */ import com.goldhuman.IO.Protocol.ProtocolException;
/*    */ import com.goldhuman.IO.Protocol.Session;
/*    */ 
/*    */ public final class PublicChat extends Protocol
/*    */ {
/*    */   public byte channel;
/*    */   public byte emotion;
/*    */   public int roleid;
/*    */   public int localsid;
/*    */   public Octets msg;
/*    */   public Octets data;
/*    */ 
/*    */   public PublicChat()
/*    */   {
/* 19 */     this.msg = new Octets();
/* 20 */     this.data = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 25 */     os.marshal(this.channel);
/* 26 */     os.marshal(this.emotion);
/* 27 */     os.marshal(this.roleid);
/* 28 */     os.marshal(this.localsid);
/* 29 */     os.marshal(this.msg);
/* 30 */     os.marshal(this.data);
/* 31 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 36 */     this.channel = os.unmarshal_byte();
/* 37 */     this.emotion = os.unmarshal_byte();
/* 38 */     this.roleid = os.unmarshal_int();
/* 39 */     this.localsid = os.unmarshal_int();
/* 40 */     os.unmarshal(this.msg);
/* 41 */     os.unmarshal(this.data);
/* 42 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 49 */       PublicChat o = (PublicChat)super.clone();
/* 50 */       o.msg = ((Octets)this.msg.clone());
/* 51 */       o.data = ((Octets)this.data.clone());
/* 52 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 55 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.PublicChat
 * JD-Core Version:    0.6.2
 */