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
/*    */ public final class WorldChat extends Protocol
/*    */ {
/*    */   public byte channel;
/*    */   public byte emotion;
/*    */   public int roleid;
/*    */   public Octets name;
/*    */   public Octets msg;
/*    */   public Octets data;
/*    */ 
/*    */   public WorldChat()
/*    */   {
/* 19 */     this.name = new Octets();
/* 20 */     this.msg = new Octets();
/* 21 */     this.data = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 26 */     os.marshal(this.channel);
/* 27 */     os.marshal(this.emotion);
/* 28 */     os.marshal(this.roleid);
/* 29 */     os.marshal(this.name);
/* 30 */     os.marshal(this.msg);
/* 31 */     os.marshal(this.data);
/* 32 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 37 */     this.channel = os.unmarshal_byte();
/* 38 */     this.emotion = os.unmarshal_byte();
/* 39 */     this.roleid = os.unmarshal_int();
/* 40 */     os.unmarshal(this.name);
/* 41 */     os.unmarshal(this.msg);
/* 42 */     os.unmarshal(this.data);
/* 43 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 50 */       WorldChat o = (WorldChat)super.clone();
/* 51 */       o.name = ((Octets)this.name.clone());
/* 52 */       o.msg = ((Octets)this.msg.clone());
/* 53 */       o.data = ((Octets)this.data.clone());
/* 54 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 57 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.WorldChat
 * JD-Core Version:    0.6.2
 */