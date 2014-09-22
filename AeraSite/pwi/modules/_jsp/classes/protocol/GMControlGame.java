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
/*    */ public final class GMControlGame extends Protocol
/*    */ {
/*    */   public int xid;
/*    */   public int worldtag;
/*    */   public Octets command;
/*    */ 
/*    */   public GMControlGame()
/*    */   {
/* 16 */     this.command = new Octets();
/*    */   }
/*    */ 
/*    */   public OctetsStream marshal(OctetsStream os)
/*    */   {
/* 21 */     os.marshal(this.xid);
/* 22 */     os.marshal(this.worldtag);
/* 23 */     os.marshal(this.command);
/* 24 */     return os;
/*    */   }
/*    */ 
/*    */   public OctetsStream unmarshal(OctetsStream os) throws MarshalException
/*    */   {
/* 29 */     this.xid = os.unmarshal_int();
/* 30 */     this.worldtag = os.unmarshal_int();
/* 31 */     os.unmarshal(this.command);
/* 32 */     return os;
/*    */   }
/*    */ 
/*    */   public Object clone()
/*    */   {
/*    */     try
/*    */     {
/* 39 */       GMControlGame o = (GMControlGame)super.clone();
/* 40 */       o.command = ((Octets)this.command.clone());
/* 41 */       return o;
/*    */     } catch (Exception e) {
/*    */     }
/* 44 */     return null;
/*    */   }
/*    */ 
/*    */   public void Process(Manager manager, Session session)
/*    */     throws ProtocolException
/*    */   {
/*    */   }
/*    */ }

/* Location:           D:\PW\1.4.5iweb\iweb\WEB-INF\classes\
 * Qualified Name:     protocol.GMControlGame
 * JD-Core Version:    0.6.2
 */